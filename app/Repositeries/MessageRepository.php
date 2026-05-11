<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Message;

class MessageRepository implements CommonInterface
{
    public function getAll()
    {
        return Message::all();
    }

    public function getAnnouncements()
    {
        return Message::where('type', 'announcement')->latest()->get();
    }

    public function getMessagesForStudent($studentId)
    {
        return Message::where('student_id', $studentId)
            ->where('type', 'message')
            ->latest()
            ->get();
    }

    public function create(array $details)
    {
        return Message::create($details);
    }

    public function show($id)
    {
        return Message::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $message = Message::findOrFail($id);
        $message->update($details);
        return $message;
    }

    public function delete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return true;
    }

    public function findById($id)
    {
        return Message::find($id);
    }
}
