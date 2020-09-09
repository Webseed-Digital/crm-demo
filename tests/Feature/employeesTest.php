<?php

namespace Tests\Feature;

use App\Employee;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class employeesTest extends TestCase
{
    /**
     * Set up the tests with some common details
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('employees');
        $this->setBaseModel('App\Employee');
    }

    /**
     * @test Ensure that unauthenticated users cannot access the index
     */
    public function testRedirectWithoutAuthentication()
    {
        $response = $this->get('/employees');

        $response->assertRedirect('/login');
    }

    /**
     * @test Ensure that authenticated users can access the index
     */
    public function testRedirectAuthenticatedUsers()
    {
        $this->signIn();
        $response = $this->get('/employees');

        // Since we're logged in we should be taken to the dashboard
        $response->assertStatus(200);
    }

    /**
     * @test Test that authenticated users can create employees
     */
    public function testCreateEmployee()
    {
        $this->signIn();
        $this->create();
    }

    /**
     * @test Test that unauthenticated users cannot create employees
     */
    public function testUnauthenticatedUsersCannotCreateEmployees()
    {
        $this->create();
    }

    /**
     * @test Test that all the basic validation for creating employees works
     */
    public function testCreateEmployeesRequiredValidation()
    {
        $this->signIn();
        $this->post( route('employees.store'), [])->assertSessionHasErrors(['first_name', 'surname', 'email_address', 'phone', 'company_id']);
    }

    /**
     * @test Test that authenticated users can update employees
     */
    public function testUpdateEmployee()
    {
        $this->signIn();
        $this->update(factory('App\Employee')->make()->toArray());
    }

    /**
     * @test Test that unauthenticated users cannot update employees
     */
    public function testUnauthenticatedUsersCannotUpdateEmployees()
    {
        $this->update(factory('App\Employee')->make()->toArray());
    }

    /**
     * @test Test that the basic validation for updating employees works
     */
    public function testUpdateEmployeesRequiredValidation()
    {
        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model);

        $this->signIn();
        $response = $this->patch(route($route, $model->id), [])->assertSessionHasErrors(['first_name', 'surname', 'email_address', 'phone', 'company_id']);
    }

    /**
     * @test Test authenticated users can delete employees
     */
    public function testDeleteEmployee()
    {
        $this->signIn();
        $this->destroy()->assertSessionDoesntHaveErrors();
    }

    /**
     * @test Test that unauthenticated users cannot delete employees
     */
    public function testUnauthenticatedUsersCannotDeleteEmployees()
    {
        $this->destroy()->assertRedirect('/login');
    }
}
