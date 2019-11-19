<p align="center"><img alt="Nova Login As" src="https://coderello.com/images/packages/nova-login-as.png" width="500"></p>

<p align="center"><b>Nova Login As</b> provides an easy way to login as any user from Laravel Nova.</p>

## Install

You can install this package via composer using this command:

```bash
composer require coderello/nova-login-as
```

## Usage

The only thing you need to do in order to make it work after the installation is to add `LoginAs` action to the `User` Nova resource.

```php
public function actions(Request $request)
{
    return [
        new \Coderello\LoginAs\Actions\LoginAs,
    ];
}
```

Now you can run `LoginAs` action on the needed user after which you will be redirected to the home page of the website being authenticated as needed user.

## Redirection direction

By default you'll be redirected to the `home` route if it exists or the `/` if not.

If you want, you are free to customize the redirection direction by passing the `Closure` with your logic to the `->redirectTo()` method.

```php
public function actions(Request $request)
{
    return [
        (new \Coderello\LoginAs\Actions\LoginAs)
            ->redirectTo(function ($user) {
                return route('profile', $user);
            }),
    ];
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
