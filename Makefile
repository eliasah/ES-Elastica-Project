compile:
	composer install --no-dev
update:
	composer update
clean:
	@rm -Rf *~
mrproper: clean
	@rm -Rf vendor *.lock