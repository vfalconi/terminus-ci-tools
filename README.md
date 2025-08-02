# Terminus CI tools
![Packagist Version](https://img.shields.io/packagist/v/vfalconi/terminus-ci-tools)

## Configuration

These commands require no configuration

## Usage
```bash
terminus checkEnv -- <site>.<test|live>
# throws an exception if the environment has nothing to deploy
# returns the string 'deployable' otherwise
```

## Installation

```
mkdir -p $HOME/terminus/local_plugins
git clone https://github.com/vfalconi/terminus-ci-tools $HOME/terminus/local_plugins/terminus-ci-tools
terminus self:plugin:install $HOME/terminus/local_plugins/terminus-ci-tools
```

## Testing
This example project includes four testing targets:

* `composer lint`: Syntax-check all php source files.
* `composer cs`: Code-style check.
* `composer unit`: Run unit tests with phpunit
* `composer functional`: Run functional test with bats

To run all tests together, use `composer test`.

Note that prior to running the tests, you should first run:
* `composer install`
* `composer install-tools`
