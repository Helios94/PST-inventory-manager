<?php

namespace App\Nova;

use App\Models\FoodOperation;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use Laravel\Nova\Query\Builder;
use ZiffMedia\NovaSelectPlus\SelectPlus;

class Operation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Operation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Operations';

    /**
     * The side nav menu order.
     *
     * @var int
     */
    public static $priority = 1;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Textarea::make('Description'),
            Avatar::make('Image'),
            BelongsTo::make('User', 'user1'),
            BelongsTo::make('User', 'user2'),
//            SelectPlus::make('Foods', 'foods', Food::class),
            SelectPlus::make('foods', 'foods', Food::class),
//                ->optionsQuery(function (Builder $query) {
//                    $query->
//                }),
            BelongsToMany::make('Foods', 'foods', Food::class)
                ->fields(new FoodOperationFields()),
            Number::make('QTY', 'quantity')->sortable(),
            Select::make('Type')->options([
                    'Food' => 'Food',
                    'Office Supply' => 'Office Supply',
                ]),
            Select::make('Status')->options([
                    'Waiting' => 'Waiting',
                    'Approved' => 'Approved',
                    'Declined' => 'Declined',
                ])->hideFromIndex()
                ->hideFromDetail(),
            Status::make('Status')
                ->loadingWhen(['Waiting'])
                ->failedWhen(['Declined'])
                ->hideWhenCreating()
                ->hideWhenUpdating(),
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
        return [];
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
     *
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
        return [];
    }
}
