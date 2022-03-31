<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
//use Laminas\Diactoros\Response\JsonResponse;
use Cake\Http\Response;
use Cake\Http\Cookie\Cookie;
use PHPUnit\Util\Json;
use App\Model\Entity\Company;
use App\Model\Entity\Contact;
use App\Model\Table\CompaniesTable;
use App\Model\Table\ContactsTable;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class ApiController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function contactsIndex()
        {
            $contactsTable = new ContactsTable;
            $contacts = $contactsTable->find("all");
            $this->response->type('json');
            $data = json_encode($contacts->toArray());
            $this->response->body($data);
            return $this->response;
        }
    public function companiesIndex()
    {
            $contactsTable = new ContactsTable;
            $contacts = $contactsTable->find("all");
            $this->response->type('json');
            $data = json_encode($contacts->toArray());
            $this->response->body($data);
            return $this->response;
    }

    public function insertContacts()
    {  $data = $this->request->getData();
        try {

        $contactsTable = new ContactsTable;
        $entity = $contactsTable->newEntity($data, ['validate' => false]);
            $data = [
                'status'=> "1",
                'Message' => "Contacts Data Inserted"
            ];
            $this->response->body(json_encode($data));
            return $this->response;

        }catch (\Exception $e){
           $data = [
               'status'=> "0",
               'error' => $e->getMessage()
           ];
            $this->response->body(json_encode($data));
            return $this->response;
        }

    }
}
