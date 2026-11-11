<?php

namespace App\Libraries;

use Chillerlan\QRCode\QRCode;

class QrCodeGenerator
{
    public function generate(int $driverId, int $vehicleId, int $userId): array
    {
        $token = bin2hex(random_bytes(32));
        $content = site_url('verify/' . $token);
        $directory = FCPATH . 'uploads/qrcodes';
        if (! is_dir($directory)) mkdir($directory, 0777, true);
        $path = $directory . DIRECTORY_SEPARATOR . $token . '.png';
        $qr = new QRCode();
        $qrData = $qr->render($content);
        file_put_contents($path, $qrData);
        $model = new \App\Models\QrCodeModel();
        $id = $model->insert([
            'driver_id' => $driverId,
            'vehicle_id' => $vehicleId,
            'token' => $token,
            'image_path' => 'uploads/qrcodes/' . $token . '.png',
            'status' => 'active',
            'generated_by' => $userId,
        ]);
        return ['id' => $id,'token' => $token,'image_path' => 'uploads/qrcodes/' . $token . '.png','url' => $content];
    }
}
