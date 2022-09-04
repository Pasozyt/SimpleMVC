<?php 

namespace Http\Controllers;

use Http\Requests\Request;
use Views\View;
use Http\Controllers\Controller;
use Http\Requests\CityRequest;
use Models\Repositories\CityRepository;

class CityController extends Controller
{
    private $cityRepository;
    private $view;

    public function __construct(
        CityRepository $cityRepository, 
        View $view
    ) {
        $this->cityRepository = $cityRepository;
        $this->view = $view;
    }

    public function index()
    {
        $this->view->render(
            'city',
            [
                'title' => __('city.title'),
                'city' => $this->cityRepository->all(),
                'addTitle' => __('city.add-title'),
                'addButton' => __('city.add-button')                
            ]
        );
    }

    public function add(CityRequest $request)
    {
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            // TODO: PUT ERRORS INTO SESSION
            // $this->redirect("");
            d($errorsBag);
            exit();
        }
        $id = $this->cityRepository->insert(
            $this->cityRepository->create([
                'name' => $request->post('city_name')
            ])
        );
        if ($id < 0) {
            throw new DatabaseException();
        }
        $this->redirect("city");        
    }    

    public function del(Request $request)
    {
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            d($errorsBag);
            exit();
        }

        $id = $this->cityRepository->delete($request->post('city_id'));

        if ($id < 0) {
            throw new DatabaseException();
        }
        $this->redirect("city");

    }
}