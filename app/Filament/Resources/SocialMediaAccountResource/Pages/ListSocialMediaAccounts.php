<?php

namespace App\Filament\Resources\SocialMediaAccountResource\Pages;

use App\Filament\Resources\SocialMediaAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialMediaAccounts extends ListRecords
{
    protected static string $resource = SocialMediaAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
