<?php

namespace App\Livewire\Front;
use Livewire\Attributes\Layout;
use App\Jobs\SendMailJob;
use App\Models\Contact;
use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactUs extends Component
{
    public $name;
    #[Validate]

    public $email;
    #[Validate]

    public $number;
    #[Validate]
    public $message;
    #[Validate]

    public $adminEmail;

    public $captcha;
    public $captchaGenerate;

    public $captchaInput;

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:5', 'max:30'],
            'message' => ['required', 'min:5', 'max:500'],
            'number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'captchaInput' => ['required', 'string', 'size:6'],

        ];
    }

    #[Layout('layouts.web')]

    public function render()
    {
        
        $this->adminEmail = Setting::where('key', 'admin_email')->first()->value ?? '';
        return view('livewire.front.contact-us');
    }

    public function mount()
    {
        $this->generateCaptcha();
    }

    public function generateCaptcha()
    {
        // Generate a random string for the captcha (you can customize this)
        $captchaString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        $this->captchaGenerate = $captchaString;
        // Set font size and calculate text dimensions
        $fontSize = 30;
        $fontWidth = imagefontwidth(5); // 5 is the font size
        $fontHeight = imagefontheight(5); // 5 is the font size
    
        // Calculate image width and height
        $imageWidth = strlen($captchaString) * ($fontWidth + 10); // Add space between digits
        $imageHeight = $fontHeight + 10; // Add some padding
    
        // Create an image with the captcha string overlaid
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $backgroundColor = imagecolorallocate($image, 243, 244, 246); // Light gray background
        imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $backgroundColor);
    
        // Define an array of random colors for digits
        $colors = [
            imagecolorallocate($image, 255, 0, 0),   // Red
            imagecolorallocate($image, 0, 255, 0),   // Green
            imagecolorallocate($image, 0, 0, 255),   // Blue
            imagecolorallocate($image, 255, 0, 255), // Magenta
            imagecolorallocate($image, 0, 255, 255), // Cyan
        ];
    
        // Calculate character spacing
        $charSpacing = 10;
    
        // Initial x-coordinate for the first character
        $x = $charSpacing;
    
        // Add each character to the image with different colors and spacing
        for ($i = 0; $i < strlen($captchaString); $i++) {
            $char = $captchaString[$i];
            $color = $colors[array_rand($colors)]; // Select a random color
            imagestring($image, 5, $x, 5, $char, $color);
            $x += $fontWidth + $charSpacing; // Increment x-coordinate by character width + spacing
        }
    
        // Output the image
        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();
        $captchaImage = 'data:image/png;base64,' . base64_encode($imageData);
    
        $this->captcha = $captchaImage;
        
    }
    
    

    public function StoreContact(){
        
        $this->validate();
        
        if ($this->captchaInput === $this->captchaGenerate) {
        } else {
            $this->addError('captchaInput', 'The captcha is incorrect.');
        }

        

        Contact::create([
            "name" => $this->name ,
            "email" => $this->email ,
            "number" => $this->number,
            "message" => $this->message
            ]);

             // email for admin.
            // $heading = '<h1>Contact Form Notification</h1>';
            // $subject = "hotTrust Contact Form enquiry";
            
            // $name = 'Admin';
            // $mailtTo = Setting::where('key', 'admin_email')->first()?->value;
            // $body = '';
            // $body .= "<p>Dear {$name},</p>";
            
            // $body .= "<p>You have received a new message from the contact form:</p>";
            
            // $body .= "<ul style='padding-left: 20px'>
            //               <li><strong>Name: </strong>{$this->name}</li>
            //               <li><strong>Email: </strong>{$this->email}</li>
            //               <li><strong>Number: </strong>{$this->number}</li>
            //               <li><strong>Message: </strong>{$this->message}</li>
            //           </ul>";
            
            // $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
            
            // dispatch(new SendMailJob($data, $mailtTo));

            // // email for user.
            // $heading = '<h1>Contact Form Confirmation</h1>';
            // $subject = "Contact Form Submission Confirmation";

            // $name = $this->name;
            // $userEmail = $this->email;

            // $body = '';
            // $body .= "<p>Dear {$name},</p>";

            // $body .= "<p>Thank you for contacting us. Your message has been received and we will get back to you shortly.</p>";

            // $body .= "<p>If you have any further questions or concerns, feel free to reach out to us.</p>";

            // $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

            // dispatch(new SendMailJob($data, $userEmail));

            $this->reset(['name', 'email', 'number', 'message']);

            session()->flash("success", "We have received your message.");
            return back() ; 

    }
}
