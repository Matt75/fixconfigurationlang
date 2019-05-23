# Fix Configuration Lang

## About

A PrestaShop Module for help merchants to adds missing configuration language keys

Typically if you encountered an error 500 on Invoice page or Delivery Slips page for example.
```
Symfony\Component\Form\Exception\UnexpectedTypeException:
Expected argument of type "object, array or empty", "string" given
```

# Download the latest version of this module
[Go to releases][releases] Use fixconfigurationlang.zip link of the latest version available

# After installation in your PrestaShop instance
Go to module configuration

![capture d ecran 2019-03-07 a 15 30 43](https://user-images.githubusercontent.com/5262628/53963703-16c64f00-40ee-11e9-990a-c93a168cff8e.png)

As you can see, there is a problem with `PS_INVOICE_FREE_TEXT`

After click on Repare button, it will be fixed
![capture d ecran 2019-03-07 a 15 33 09](https://user-images.githubusercontent.com/5262628/53963839-5bea8100-40ee-11e9-80d8-fae3d1612603.png)

After using this module, you can uninstall and delete it.

## Reporting issues

You can report issues with this module in this repository. [Click here to report an issue][report-issue]. 

## Contributing

PrestaShop modules are open source extensions to the PrestaShop e-commerce solution. Everyone is welcome and even encouraged to contribute with their own improvements.

### Requirements

Contributors **must** follow the following rules:

* **Make your Pull Request on the "dev" branch**, NOT the "master" branch.
* Do not update the module's version number.
* Follow [the coding standards][1].

### Process in details

Contributors wishing to edit a module's files should follow the following process:

1. Create your GitHub account, if you do not have one already.
2. Fork this project to your GitHub account.
3. Clone your fork to your local machine in the ```/modules``` directory of your PrestaShop installation.
4. Create a branch in your local clone of the module for your changes.
5. Change the files in your branch. Be sure to follow the [coding standards][1]!
6. Push your changed branch to your fork in your GitHub account.
7. Create a pull request for your changes **on the _'dev'_ branch** of the module's project. Be sure to follow the [contribution guidelines][2] in your pull request. If you need help to make a pull request, read the [GitHub help page about creating pull requests][3].
8. Wait for one of the core developers either to include your change in the codebase, or to comment on possible improvements you should make to your code.

That's it: you have contributed to this open source project! Congratulations!

## License

This module is released under the [Academic Free License 3.0][AFL-3.0] 

[releases]: https://github.com/Matt75/fixconfigurationlang/releases
[report-issue]: https://github.com/Matt75/fixconfigurationlang/issues/new
[1]: https://devdocs.prestashop.com/1.7/development/coding-standards/
[2]: https://devdocs.prestashop.com/1.7/contribute/contribution-guidelines/
[3]: https://help.github.com/articles/using-pull-requests
[AFL-3.0]: https://opensource.org/licenses/AFL-3.0
