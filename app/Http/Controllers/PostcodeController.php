<?php 

namespace Http\Controllers;

use Http\Requests\Request;
use Views\View;
use Http\Controllers\Controller;
use Exceptions\DatabaseException;
use Http\Requests\PostcodeRequest;
use Models\Repositories\PostcodeRepository;

class PostcodeController extends Controller
{
    private $postcodeRepository;
    private $view;

    public function __construct(
        PostcodeRepository $postcodeRepository, 
        View $view
    ) {
        $this->postcodeRepository = $postcodeRepository;
        $this->view = $view;
    }

    public function index()
    {
        $this->view->render(
            'postcode',
            [
                'title' => __('postcode.title'),
                'postcode' => $this->postcodeRepository->all(),
                'addTitle' => __('postcode.add-title'),
                'addButton' => __('postcode.add-button')                
            ]
        );
    }

    public function add(PostcodeRequest $request)
    {
        
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            d($errorsBag);
            exit();
        }
        $id = $this->postcodeRepository->insert(
            $this->postcodeRepository->create([
                'postcode' => $request->post('postcode_postcode')
            ])
        );
        if ($id < 0) {
            throw new DatabaseException();
        }
        $this->redirect("postcode");        
    }

    public function del(Request $request)
    {
        $errorsBag = $request->validate();
        if ($errorsBag !== null) {
            d($errorsBag);
            exit();
        }

        $id = $this->postcodeRepository->delete($request->post('postcode_id'));

        if ($id < 0) {
            throw new DatabaseException();
        }
        $this->redirect("postcode");

    }
}