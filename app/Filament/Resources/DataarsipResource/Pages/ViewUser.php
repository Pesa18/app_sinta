<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use App\Models\Dataarsip;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\DataarsipResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = DataarsipResource::class;
}
