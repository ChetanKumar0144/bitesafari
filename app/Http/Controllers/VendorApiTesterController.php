<?php
// app/Http/Controllers/VendorApiTesterController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class VendorApiTesterController extends Controller
{
    public function index()
    {
        // Saare registered routes uthao
        $allRoutes = Route::getRoutes();
        $vendorModules = [];

        foreach ($allRoutes as $route) {
            $uri = $route->uri();

            // Sirf 'api/v1/vendor' wale routes filter karo
            if (Str::contains($uri, 'api/v1/vendor')) {

                // URI se "api/v1/vendor/" hatao taaki clean name mile
                $cleanPath = str_replace('api/v1/vendor/', '', $uri);

                $moduleName = explode('/', $cleanPath)[0];
                $moduleName = Str::title($moduleName ?: 'General');

                $vendorModules[$moduleName][] = [
                    'label'  => str_replace(['/', '-'], '_', $cleanPath) ?: 'index',
                    'method' => $route->methods()[0], // GET, POST etc.
                    'path'   => str_replace('api/', '', $uri), // Tester expects path without 'api/' prefix
                    'full_path' => $uri,
                    'action' => $route->getActionName(),
                ];
            }
        }

        return view('vendor.vendor-api-tester', ['modules' => $vendorModules]);
    }
}
