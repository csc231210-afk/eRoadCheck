<?php

namespace App\Libraries;

class RevenueStatusService
{
    public function status(array $record): string
    {
        $status = (string) ($record['payment_status'] ?? 'pending');
        if ($status === 'paid' && ! empty($record['expiry_date']) && $record['expiry_date'] < date('Y-m-d')) return 'expired';
        return $status;
    }
}
