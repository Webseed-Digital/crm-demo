<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class companiesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('companies');
        $this->setBaseModel('App\Company');
    }

    /**
     * @test Ensure that unauthenticated users cannot access the index
     */
    public function testRedirectWithoutAuthentication()
    {
        $response = $this->get('/companies');

        $response->assertRedirect('/login');
    }

    /**
     * @test Ensure that authenticated users can access the index
     */
    public function testRedirectAuthenticatedUsers()
    {
        $this->signIn();
        $response = $this->get('/companies');

        // Since we're logged in we should be taken to the dashboard
        $response->assertStatus(200);
    }

    /**
     * @test Test that authenticated users can create companies
     */
    public function testCreateCompany()
    {
        $this->signIn();
        $this->create([], '', '', ['logo']);
    }

    /**
     * @test Test that unauthenticated users cannot create companies
     */
    public function testUnauthenticatedUsersCannotCreateCompanies()
    {
        $this->create([], '', '', ['logo']);
    }

    /**
     * @test Test that all the basic validation for creating companies works
     */
    public function testCreateCompaniesRequiredValidation()
    {
        $this->signIn();
        $this->post( route('companies.store'), [])->assertSessionHasErrors(['name', 'website', 'email_address', 'logo']);
    }

    /**
     * @test Test that an invalid image (less than 100x100) will generate an error
     */
    public function testCreatingCompanyWithInvalidImage()
    {
        $this->signIn();
        $company = factory('App\Company')->make();
        $company->logo = UploadedFile::fake()->image('logo.jpg', 99, 99);
        $this->post( route('companies.store'), $company->toArray())->assertSessionHasErrors(['logo']);
    }

    /**
     * @test Test that authenticated users can update companies
     */
    public function testUpdateCompany()
    {
        $this->signIn();
        $this->update(factory('App\Company')->make()->toArray(), '', '', ['logo']);
    }

    /**
     * @test Test that unauthenticated users cannot update companies
     */
    public function testUnauthenticatedUsersCannotUpdateCompanies()
    {
        $this->update(factory('App\Company')->make()->toArray(), '', '', ['logo']);
    }

    /**
     * @test Test that the basic validation for updating companies works
     */
    public function testUpdateCompaniesRequiredValidation()
    {
        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model);

        $this->signIn();
        $response = $this->patch(route($route, $model->id), [])->assertSessionHasErrors(['name', 'website', 'email_address']);
    }

    /**
     * @test Test authenticated users can delete companies
     */
    public function testDeleteCompany()
    {
        $this->signIn();
        $this->destroy()->assertSessionDoesntHaveErrors();
    }

    /**
     * @test Test that unauthenticated users cannot delete companies
     */
    public function testUnauthenticatedUsersCannotDeleteCompanies()
    {
        $this->destroy()->assertRedirect('/login');
    }

}
