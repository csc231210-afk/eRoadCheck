<?php

namespace App\Libraries;

class DocumentStatusService
{
    public function status(array $document): string
    {
        if (($document['status'] ?? '') !== 'valid') return (string) ($document['status'] ?? 'attention_required');
        if (! empty($document['expiry_date']) && $document['expiry_date'] < date('Y-m-d')) return 'expired';
        return 'valid';
    }
}
