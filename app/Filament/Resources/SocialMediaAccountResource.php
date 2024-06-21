<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaAccountResource\Pages;
use App\Filament\Resources\SocialMediaAccountResource\RelationManagers;
use App\Models\SocialMediaAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialMediaAccountResource extends Resource
{
    protected static ?string $model = SocialMediaAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make("platform")
                            ->required()
                            ->maxLength(25),
                        Forms\Components\TextInput::make("user_name")
                            ->required()
                            ->maxLength(25),
                        Forms\Components\TextInput::make("profile_url")
                            ->prefix('https://')
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->required()
                            ->maxLength(225)
                            ->columnSpanFull()
                    ])
                    ->columns(["sm" => 2])
                    ->columnSpan(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Placeholder::make("Created at")
                        ->content(fn (?SocialMediaAccount $record) => $record ? $record->created_at->diffForHumans() : "-"),
                    Forms\Components\Placeholder::make("Updated at")
                        ->content(fn (?SocialMediaAccount $record) => $record ? $record->updated_at->diffForHumans() : "-")
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-exclamation-circle')
            ->emptyStateDescription('Here are your social media account place')
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profile_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialMediaAccounts::route('/'),
            'create' => Pages\CreateSocialMediaAccount::route('/create'),
            'edit' => Pages\EditSocialMediaAccount::route('/{record}/edit'),
        ];
    }
}
