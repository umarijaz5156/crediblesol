<?php

namespace App\Livewire\Setup;

use Livewire\Attributes\Layout;
use Livewire\Component;
use PDO;
use PDOException;

class Database extends Component
{
    public $connections;
    public $connectionTested; 
    public $db_type, $db_host, $db_port, $db_name, $db_username, $db_password;

    public function mount(array $summary = [])
    {
        $this->connectionTested = false;
        $this->connections = config('database.connections');
        $this->db_type = config('database.default');

        $this->setDatabaseConfig($this->db_type, $summary);
    }


    public function setDatabaseConfig($connectionName, $summary = [])
    {
        $config = config("database.connections.{$connectionName}");


        $this->db_type = count($summary) > 0 && isset($summary['DB_CONNECTION']) ? $summary['DB_CONNECTION'] : $config['driver'];
        $this->db_host = count($summary) > 0 && isset($summary['DB_HOST']) ? $summary['DB_HOST'] : $config['host'];
        $this->db_port = count($summary) > 0 && isset($summary['DB_PORT']) ? $summary['DB_CONNECTION'] : $config['port'];
        $this->db_name = count($summary) > 0 && isset($summary['DB_DATABASE']) ? $summary['DB_DATABASE'] : $config['database'] ?? "";
        $this->db_username = count($summary) > 0 && isset($summary['DB_USERNAME']) ? $summary['DB_USERNAME'] : $config['username'];
        $this->db_password = count($summary) > 0 && isset($summary['DB_PASSWORD']) ? $summary['DB_PASSWORD'] : str_replace('"', '', $config['password']);
    }

    public function testDB()
    {
        $this->resetErrorBag();
        if ($this->db_type == 'mysql') {
            $response = $this->testMySql();
            $data = $response->getData();

            if ($data->State == "200") {
                session()->flash('success', $data->Success);
                $this->connectionTested = true;
            } else {
                $this->addError('db_connection_error', $data->Error);
            }

            return;
        }

        return $this->addError('db_connection_error', 'DB Type not Supported for testing');
    }

    public function testMySql()
    {
        $db_type = $this->db_type;
        $db_host = $this->db_host;
        $db_name = $this->db_name;
        $db_user = $this->db_username;
        $db_pass = $this->db_password;
        $db_port = $this->db_port;

        if (!$db_name) {
            return response()->json([
                'Error' => 'No Database',
                'State' => '999',
            ]);
        }

        if (!$db_user) {
            return response()->json([
                'Error' => 'No Username',
                'State' => '999',
            ]);
        }

        if (!$db_port) {
            return response()->json([
                'Error' => 'No Port',
                'State' => '999',
            ]);
        }

        if (!$db_host) {
            return response()->json([
                'Error' => 'No Host',
                'State' => '999',
            ]);
        }

        try {
            $db = new PDO($db_type . ':host=' . $db_host . ';port=' . $db_port . ';dbname=' . $db_name, $db_user, $db_pass, array(
                PDO::ATTR_TIMEOUT => '5',
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_LOCAL_INFILE => true
            )
            );
        } catch (PDOException $e) {
            if ($e->getCode() == '1049' && !$db_name == '') {
                $db = new PDO($db_type . ':host=' . $db_host . ';port=' . $db_port . ';dbname=' . '', $db_user, $db_pass, array(
                    PDO::ATTR_TIMEOUT => '5',
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true
                )
                );
                $db->query("CREATE DATABASE IF NOT EXISTS $db_name");
                return response()->json([
                    'State' => '200',
                    'Success' => 'Database ' . $db_name . ' created',
                ]);
            }

            return response()->json([
                'Error' => $e->getMessage(),
                'State' => $e->getCode(),
            ]);
        }

        return response()->json([
            'State' => '200',
            'Success' => 'Seems okay',
        ]);

    }




    public function submitData()
    {
        $this->validate([
            'db_type' => 'required|min:2|max:200',
            'db_host' => 'required',
            'db_port' => 'required',
            'db_name' => 'required|min:2|max:200',
            'db_password' => 'required|min:2'
        ]);

        $connection = $this->db_type;

        $selectedConnection = $this->connections[$connection];

        $data = [];

        if ($this->db_type != config('database.default')) {
            $data['DB_CONNECTION'] = $this->db_type;
        }

        if ($this->db_host != $selectedConnection['host']) {
            $data['DB_HOST'] = $this->db_host;
        }

        if ($this->db_port != $selectedConnection['port']) {
            $data['DB_PORT'] = $this->db_port;
        }

        if ($this->db_name != $selectedConnection['database']) {
            $data['DB_DATABASE'] = $this->db_name;
        }

        if ($this->db_username != $selectedConnection['username']) {
            $data['DB_USERNAME'] = $this->db_username;
        }

        if ($this->db_password != $selectedConnection['password']) {
            $data['DB_PASSWORD'] = $this->db_password;
        }

        if (count($data) > 0) {
            $this->dispatch('summary', settings: $data);
        }

        $this->dispatch('change-step', 4);
    }

    public function render()
    {
        return view('livewire.setup.database');
    }
}
