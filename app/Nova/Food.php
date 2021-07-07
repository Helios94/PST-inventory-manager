<?php

namespace App\Nova;

use App\Nova\Metrics\FoodExpenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Food extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Food::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Items';

    /**
     * The side nav menu order.
     *
     * @var int
     */
    public static $priority = 1;

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return $this->barcode;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable()
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Avatar::make('Image'),
            Text::make('Name')->sortable(),
            Text::make('Barcode')->creationRules('unique:food,barcode')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Avatar::make('QR Code', 'qrcode_path')->creationRules('unique:food,qrcode_path')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Textarea::make('Description')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Number::make('QTY', 'quantity')->sortable()
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            BelongsTo::make('Unit')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Currency::make('Price')->locale('tn')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            Boolean::make('Share', 'shareable')->sortable()
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            DateTime::make('Expiry Date', 'expiry_date',)->sortable()
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            BelongsTo::make('User')
                ->searchable()
                ->hideWhenCreating(function (){
                    return !\App\Models\User::find(Auth::id())->isAdmin();
                })
                ->hideWhenUpdating(function (){
                    return !\App\Models\User::find(Auth::id())->isAdmin();
                }),
            BelongsTo::make('Category')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            BelongsTo::make('Storage')
                ->hideFromIndex(function (ResourceIndexRequest $request) {
                    return $request->viaRelationship();
                }),
            BelongsToMany::make('Operations', 'operations', Operation::class)
                ->fields(new FoodOperationFields()),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        if(\App\Models\User::find(Auth::id())->isAdmin())
        {
            return [
                new FoodExpenses(),
            ];
        }
        else
        {
            return [];
        }
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *aut
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
//            new DownloadExcel(),
        ];
    }
}
