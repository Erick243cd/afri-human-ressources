<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\EmployeeModel;
use App\Models\PointageModel;
use App\Models\ServiceModel;
use App\Models\SmigModel;
use App\Models\TauxTransportModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->validation = Services::validation();

        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->smigModel = new SmigModel();
        $this->employeeModel = new EmployeeModel();
        $this->serviceModel = new ServiceModel();
        $this->pointageModel = new PointageModel();
        $this->TauxTransportModel = new TauxTransportModel();

        helper(['form', 'url', 'text', 'img', 'custom', 'html']);
    }
}
