<?php

namespace App\Filament\Resources\SocialMediaAccountResource\Pages;

use App\Filament\Resources\SocialMediaAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialMediaAccount extends EditRecord
{
    protected static string $resource = SocialMediaAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
