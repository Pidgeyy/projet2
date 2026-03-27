<?php
namespace App\Controllers\Api;

use App\Core\Auth;
use App\Core\Response;

class TicketApiController
{
    public function index()
    {
        Auth::requireLogin();

        // static/mock data for now
        $tickets = [
            ['id' => 1, 'title' => 'WiFi not working', 'status' => 'open', 'author' => 'Alice'],
            ['id' => 2, 'title' => 'Printer jam', 'status' => 'in_progress', 'author' => 'Bob'],
        ];

        Response::json(['tickets' => $tickets]);
    }

    public function update()
    {
        Auth::requireLogin();

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (!$data || !isset($data['id']) || !isset($data['status'])) {
            Response::json(['message' => 'Invalid payload'], 400);
        }

        // In a real app: persist status update.
        Response::json(['message' => 'Ticket status updated', 'ticket' => ['id' => $data['id'], 'status' => $data['status']]]);
    }
}
