<?php

namespace App\Mail;

use App\Models\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeviceAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Device $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.devices.added');
    }
}
