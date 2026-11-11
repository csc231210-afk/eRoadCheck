<?php

namespace App\Helpers;

function app_name(): string { return 'e-RoadCheck'; }
function current_role(): string { return (string) session('role'); }
