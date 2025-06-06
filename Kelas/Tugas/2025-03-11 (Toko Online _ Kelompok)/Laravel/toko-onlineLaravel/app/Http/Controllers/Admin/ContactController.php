<?php
// app/Http/Controllers/Admin/ContactMessageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * Show the specified contact message.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Mark as read
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return view('admin.contacts.show', compact('message'));
    }

    /**
     * Mark the specified message as read.
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message marked as read.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message successfully deleted.');
    }

    /**
     * Remove multiple messages.
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('message_ids', []);

        if (empty($ids)) {
            return redirect()->route('admin.contacts.index')
                ->with('error', 'No messages selected.');
        }

        ContactMessage::whereIn('id', $ids)->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', count($ids) . ' messages successfully deleted.');
    }
}
