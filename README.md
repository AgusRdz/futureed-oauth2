# FutureED OAuth2

### Introducción
FutureED OAuth2 provee la lógica requerida para realizar una autorización mediante el uso del protocolo OAuth2. Este paquete esta diseñado exclusivamente para la plataforma FutureED y sus derivados.

======
### Licencia
FutureED OAuth2 es software de código abierto bajo una licencia MIT.

======
### Documentación Oficial
Además de la autenticación típica, basada en formularios, Laravel también proporciona una manera simple y conveniente para autenticarse con los proveedores de OAuth utilizando FutureED OAuth2.
Esta implementación permite realizar el inicio de sesión y el acceso a las aplicaciones derivadas de la plataforma FutureED.

Para realizar la instalación agrega a tu archivo `composer.json` la dependencia:

`composer require futureed/oauth2`

### Configuración
Después de instalar la librería FutureED/OAuth2, en tu archivo de configuración `config/app.php` registra el siguiente ServiceProvider:

```
'providers' => [
  // Proveedores de servicios instalados
  FutureED\OAuth2\FutureEDServiceProvider::class,
],
```

Además, añade el facade FutureED al arreglo de alias en tu archivo de configuración:
`'FutureED' => FutureED\OAuth2\Facades\FutureED::class,`

### Uso Básico
Se necesitan dos rutas: una para redireccionar el usuario al Proveedor de OAuth, y otra para recibir la respuesta después de la autorización:
En tu archivo `app/Http/routes.php`:
```php
<?php
Route::group(['middleware' => ['web']],
  Route::get('/oauth/futureed', [
    'as' => 'redirectToFutureED',
    'uses' => 'Auth\AuthController@redirectToFutureED'
  ]);
  Route::get('/oauth/callback', 'Auth\AuthController@callback'
  ]);
);
```

En tu controlador:

```php
<?php
namespace App\Http\Controllers;
use FutureED;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  /**
   * Redirecciona al usuario a la pagina de autenticación de FutureED.
   *
   * @return Response
   */
  public function redirectToFutureED()
  {
    return FutureED::driver('FutureED')->redirect();
  }

  /**
   * Obtiene la informacion del usuario de FutureED.
   *
   * @return Response
   */
  public function callback(Request $request)
  {
    $user = FutureED::driver('FutureED')->user($request);
    // $user->token;
  }
}
```

Es importante aclarar que los nombres de las rutas, métodos y controladores pueden variar de acuerdo a tus necesidades.

#### Obteniendo los detalles del usuario
Una vez que la respuesta ha sido satisfactoria se puede accesar a la información del usuario de la siguiente manera:
$user->email; // obtiene el correo electronico del usuario en formato de cadena de texto.
$user->getEmail(); // obtiene el correo electronico del usuario en formato de cadena de texto.

#### Otros atributos obtenidos
$user->id;
$user->token;
$user->nickname;
$user->first_name;
$user->last_name;
$user->email;
$user->avatar;


