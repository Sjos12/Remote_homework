# Makefile for easy execution of task across team members and environments.
#
# Inspired by:
# - https://localheinz.com/blog/2018/01/24/makefile-for-lazy-developers/
# - https://blog.jessekramer.io/tutorial/2018/10/22/php-projects-and-make.html
#
# Based on:
# - https://github.com/nicwortel/symfony-skeleton/blob/master/Makefile
# - https://github.com/infection/infection/blob/master/Makefile
# - https://github.com/opencfp/opencfp/blob/master/Makefile
#

.DEFAULT_GOAL := help

# See https://tech.davis-hansson.com/p/make/
MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

# Output any line in the form of `command:	\#\# Some description of the command
.PHONY: help
help:
	@echo "\033[33mUsage:\033[0m\n  make TARGET\n\n\033[32m#\n# Commands\n#---------------------------------------------------------------------------\033[0m\n"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "\033[33m%s:\033[0m%s\n", $$1, $$2}'

#
# Variables
#---------------------------------------------------------------------------

#
# Commands (phony targets)
#---------------------------------------------------------------------------

.PHONY: serve
serve:	## Serve a local development environment through Docker services
serve: services-dev vendor
	$(info Prepare Insights CMS for use...)
	./dkr art migrate

.PHONY: services-dev
services-dev:	## Serve a local development environment through Docker services
services-dev:
	$(info Starting local development environment...)
	./dkr up -d

.PHONY: services-testing
services-testing:	## Serve a testing environment through Docker services
services-testing: services-dev # For now just use local dev environment definitions
	$(info TODO: split dev services from test services and only start test services here...)

.PHONY: test
test:	## Run all test suites
test:	vendor phpstan services-testing test-unit test-acceptance
	$(info Running all test suites...)

.PHONY: test-unit
test-unit:	## Run all unit test suites
test-unit:	vendor services-testing
	$(info Running all unit test suites...)
	./dkr php vendor/bin/phpunit

.PHONY: test-acceptance
test-acceptance:	## Run all acceptance test suites
test-acceptance:	vendor services-testing
	$(info NOT YET IMPLEMENTED IN MAKE Running all acceptance test suites...)

.PHONY: phpstan
phpstan:	## Run PHPStan static code analysis
phpstan:	vendor
	$(info Running PHPStan static analysis...)
	./dkr run --rm phpstan analyze --memory-limit=2G

#
# Rules from files (non-phony targets)
#---------------------------------------------------------------------------
vendor: composer.json composer.lock
	# @todo:refactor: Make this shell independent, actually independent on how Composer is installed locally (but how?)
	zsh -i -c 'composer validate --no-check-publish --no-check-all'
	zsh -i -c 'composer install'
