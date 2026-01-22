<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Form extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ];
    }

    public function submit()
    {
        $this->validate();

        // Get settings for email
        $settings = \App\Models\Setting::getSettings();
        $toEmail = $settings->email ?? config('mail.from.address');

        // Send email
        try {
            Mail::raw($this->message, function ($mail) use ($toEmail) {
                $mail->to($toEmail)
                     ->subject('New Contact Form Submission from ' . $this->name)
                     ->replyTo($this->email, $this->name);
            });

            session()->flash('message', 'Thank you for your message! We will get back to you soon.');
            $this->reset(['name', 'email', 'message']);
        } catch (\Exception $e) {
            session()->flash('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.contact.form');
    }
}
