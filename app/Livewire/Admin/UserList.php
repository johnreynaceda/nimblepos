<?php

namespace App\Livewire\Admin;

use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())->headerActions([
                CreateAction::make('new')->label('New User')->icon('heroicon-o-plus')->form([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')->password()->required(),
                    Select::make('user_type')->options([
                        'admin' => 'admin',
                        'manager' => 'manager',
                        'cashier' => 'cashier',
                    ]),
                    Toggle::make('is_active')->label('Active')->onColor('success')->offColor('danger')->onIcon('heroicon-o-check')->offIcon('heroicon-o-x-mark')
                ])->modalWidth('xl')->modalHeading('Create User')->createAnother(false)
            ])
            ->columns([
                TextColumn::make('name')->searchable()->label('NAME')->formatStateUsing(
                    fn($record) => strtoupper($record->name)
                ),
                TextColumn::make('email')->searchable()->label('EMAIL'),
                TextColumn::make('user_type')->searchable()->label('USER TYPE')->formatStateUsing(
                    fn($record) => ucfirst($record->user_type)
                ),
                ToggleColumn::make('is_active')->label('ACTIVE')->onColor('success')->offColor('danger')->onIcon('heroicon-o-check')->offIcon('heroicon-o-x-mark'),
                

            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')->password()->required(),
                    Select::make('user_type')->options([
                        'admin' => 'admin',
                        'manager' => 'manager',
                        'cashier' => 'cashier',
                    ]),
                ])->modalWidth('xl')->modalHeading('Edit Category'),
                // DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No category yet!')->emptyStateDescription('Once you write your first category, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.user-list');
    }
}
