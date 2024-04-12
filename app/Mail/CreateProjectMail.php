<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_project, $_user)
    {
        $this->project = $_project;
        $this->user = $_user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Create Project Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.projects.CreateProjectMail',
            with: [
                'username' => $this->user->name,
                'project_title' => $this->project->title,
                'project_url' => route('admin.projects.show', $this->project),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
