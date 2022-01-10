<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentList extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The students collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $students;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $students)
    {
        $this->students = $students;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('paingthumyo41297@gmail.com', 'Assignment 5')
            ->subject('Student List')
            ->markdown('mail.list')
            ->with('students', $this->students);
    }
}
