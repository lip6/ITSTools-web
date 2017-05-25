#! /bin/sh

# we reuse the SDD_HOME variable see above script for libDDD.
cd $SDD_HOME

# checkout the ctl trunk project
svn co --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/sog-its/trunk ./ltl

# We should have a ltl folder now, it holds the ltl checker project.
cd ltl

# Builds the configure script
autoreconf -vfi

# Note the use of an absolute path to libddd source folder
# I use as path to Spot /home/thierry/local/include/spot. This would mean I have run Spot's configure with
# ./configure --with-prefix=/home/thierry/local/ ; make ; make install;
# if you installed Spot as root you can skip the libspot option to configure.
./configure --with-libddd=$SDD_HOME/libddd/src --with-libits=$SDD_HOME/libits/src --with-libspot=/home/thierry/local/include/spot --with-antlrc="$tmp"/antlr-3.4-bin

# -j just helps build faster if you have a multiprocessor machine
make -j

# Errors on tgba.hh are due to missing/misconfigured Spot install.
cd tests/
# just a small test to check everything is set up correctly.
./run_all.sh

