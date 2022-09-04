<?php 

namespace Http\Controllers;

use Views\View;
use Http\Requests\Request;
use Http\Controllers\Controller;
use Http\Requests\CombinedRequest;
use Models\Repositories\CityRepository;
use Models\Repositories\CombinedRepository;
use Models\Repositories\PostcodeRepository;

class CombinedController extends Controller
{
    private $combinedRepository;
    private $cityRepository;
    private $postcodeRepository;
    private $view;

    public function __construct(
        CombinedRepository $combinedRepository, 
        CityRepository $cityRepository,
        PostcodeRepository $postcodeRepository, 
        View $view
    ) {
        $this->combinedRepository = $combinedRepository;
        $this->cityRepository = $cityRepository;
        $this->postcodeRepository = $postcodeRepository;
        $this->view = $view;
    }

    public function index()
    {
        $this->view->render(
            'combined',
            [
                'title' => __('combined.title'),
                'combined' => $this->combinedRepository->alljoin(),
                'selectcity' => $this->cityRepository->all(),
                'selectpostcode' => $this->postcodeRepository->all(),
                'addTitle' => __('combined.add-title'),
                'addButton' => __('combined.add-button')                
            ]
        );
    }
    //Do zrobienia add
    public function add(CombinedRequest $request)
    {
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            d($errorsBag);
            exit();
        }
        $id = $this->combinedRepository->insert(
            $this->combinedRepository->create([
                'id_city' => $request->post('combined_id_city'),
                'id_code' => $request->post('combined_id_code')
            ])
        );
        if ($id < 0) {
            throw new DatabaseException();
        }
        //$this->redirect("combined");
    }   

    public function del(Request $request)
    {
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            d($errorsBag);
            exit();
        }

        $id = $this->combinedRepository->delete($request->post('combined_id'));

        if ($id < 0) {
            throw new DatabaseException();
        }
        $this->redirect("combined");

    } 
}