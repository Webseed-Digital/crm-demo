<?php

/**
 * Reusable CRUD tests based on: https://gist.github.com/wanmigs/8ed74633ddff91062f51e8b9aa2778a9
 */

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $base_route = null;
    protected $base_model = null;


    protected function signIn($user = null)
    {
        $user = $user ?? create(\App\User::class);
        $this->actingAs($user);
        return $this;
    }

    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function create($attributes = [], $model = '', $route = '', $ignoreColumns = [])
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;

        $attributes = raw($model, $attributes);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->post(route($route), $attributes)->assertSessionHasNoErrors();

        // Useful for ignoring the differences in data for uploaded files
        foreach($ignoreColumns as $columnToIgnore){
            unset($attributes[$columnToIgnore]);
        }

        $model = new $model;

        $this->assertDatabaseHas($model->getTable(), $attributes);

        return $response;
    }

    protected function update($attributes = [], $model = '', $route = '', $ignoreColumns = [])
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->patch(route($route, $model->id), $attributes);

        // Useful for ignoring the differences in data for uploaded files
        foreach($ignoreColumns as $columnToIgnore){
            unset($attributes[$columnToIgnore]);
        }

        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });

        return $response;
    }

    protected function destroy($model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.destroy" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->delete(route($route, $model->id));

        $this->assertDatabaseMissing($model->getTable(), $model->toArray());

        return $response;
    }

    public function multipleDelete ($model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.destroyAll" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model, [], 5);

        $ids = $model->map(function ($item, $key) {
            return $item->id;
        });

        return $this->delete(route($route), ['ids' => $ids ]);
    }
}
