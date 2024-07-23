<?php

namespace App\Livewire\Chat;

use App\Jobs\SendEmailJob;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ConversationChat extends Component
{
    use WithFileUploads;

    public $conversationId;
    public $userId;
    public $message;
    public $chat;
    public $details;
    public $attachments = [];
    public $uploadProgress = 0;
    public $uploading = false;

    public $allowedFileTypes = 'image/*,application/pdf,text/plain,.zip';



    protected $rules = [
        'message' => 'required|string|max:255',
        'attachments' => ['array', 'max:5'],
        'attachments.*' => ['mimes:png,doc,docx,jpg,jpeg,pdf,txt,zip', 'max:5120'],
        'attachments.*.size' => 'max:5120',
    ];
    protected $listeners = ['loadChat', 'emitRefresh' => '$refresh'];

    public function sendMessage()
    {


        $validatedData = Validator::make(
            [
                'attachments' => $this->attachments
            ],
            [
                'attachments' => ['array', 'max:5'],
                'attachments.*' => ['mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip', 'max:5120']
            ],
            [
                'attachments.*.size' => 'Max file size is 5mb'
            ],
            [
                'attachments.*' => 'attachment'
            ]
        );

        if ($validatedData->fails()) {
            $this->reset('message', 'attachments');
            $this->addError('attachments', $validatedData->errors()->first());
            return;
        }


        if ($this->message == null) {
            $this->addError('message', 'Message is Required');
            return;
        }

        $this->validate();
        $this->validateAttachmentCount();

        $conversation = Conversation::where('id', $this->conversationId)->first();

        $this->validate([
            'message' => 'required'
        ]);

        $data = [
            'conversation_id' => $conversation->id,
            'message' => $this->message,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $conversation->seller_id

        ];

        $message =   Message::create($data);

        if (count($this->attachments) > 0) {
            $files = $this->attachments;

            foreach ($files as $key => $file) {
                $ext = $file->extension();

                if (in_array($ext, ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'txt', 'pdf', 'doc', 'docx', 'zip'])) {


                    $mimeType = $file->getMimeType();

                    $name = $file->getClientOriginalName();

                    $timestamp = Carbon::now()->timestamp;

                    $path = $file->storeAs('/chats_attachments', $timestamp . '_' . $name, 'public');

                    $data = [
                        'file_path' => $path,
                    ];

                    $message->attachments()->create($data);
                }
            }
        }

             // sendEmail
             $user = User::findOrFail($conversation->seller_id);
             $senderName = User::findOrFail(auth()->user()->id);   
             $customerEmail = $user->email;
             $subject = "New Message from Buyer";
             $heading = "Message from Buyer";
     
             $body = "Hello ". $user->name .",<br><br>
             You have received a new message from <strong>{$senderName->name}</strong> (buyer). Below is the message you received:<br><br>
                     <strong>Message:</strong><br>
                     {$this->message}<br><br>
                     Please log in to your account to view the complete conversation and provide any further details or clarification if needed.<br><br>";
     
             $emailData = [
                 'body' => $body,
                 'subject' => $subject,
                 'heading' => $heading
             ];
     
             dispatch(new SendEmailJob($emailData, $customerEmail));
     

        $this->message = '';
        $this->attachments = [];


        $this->loadChat($conversation);
    }

    protected function validateAttachmentCount()
    {
        $attachmentCount = count($this->attachments);

        if ($attachmentCount > 5) {
            $this->addError('attachments_error', 'You can upload a maximum of 5 attachments.');
        }
    }

    public function updatedAttachments()
    {

        $validatedData = Validator::make(
            [
                'attachments' => $this->attachments
            ],
            [
                'attachments' => ['array', 'max:5'],
                'attachments.*' => ['mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip', 'max:5120']
            ],
            [
                'attachments.*.size' => 'Max file size is 5MB'
            ],
            [
                'attachments.*' => 'attachment'
            ]
        );

        if ($validatedData->fails()) {
            $this->reset('message', 'attachments');
            $this->uploading = false;
            $this->addError('error', $validatedData->errors()->first());
            return;
        }
    }
    public function timeoutReached()
    {

        $this->resetErrorBag();
        $this->uploading = false;
    }

    public function mount()
    {
        if ($this->conversationId) {

            $conversation = Conversation::find($this->conversationId);
            if ($conversation) {
                $this->loadChat($conversation);
            }
        }
    }

    public function loadChat($conversation)
    {
        $this->conversationId = $conversation['id'];
        $this->userId = auth()->user()->id;
        $this->chat = Conversation::with(['messages', 'buyer', 'seller'])
            ->where('id', $this->conversationId)
            ->first();

        $this->details = Conversation::with(['buyer', 'seller'])
            ->where('id', $this->conversationId)
            ->first();


        // $this->dispatch('scrollToBottom', ['id' => 'ChatArea']);
    }
    public function render()
    {
        return view('livewire.chat.conversation-chat');
    }
}
