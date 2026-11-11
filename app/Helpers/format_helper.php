<?php

namespace App\Helpers;

function format_date(?string $date): string { return $date ? date('d M Y', strtotime($date)) : '—'; }
function format_money($amount): string { return $amount === null || $amount === '' ? '—' : '₦' . number_format((float) $amount, 2); }
