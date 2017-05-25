#! /bin/sh

# we reuse the SDD_HOME variable see above script for libDDD.
cd $SDD_HOME

# checkout the ctl trunk project
svn co --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/ctl/trunk ./ctl

# We should have a ctl folder now, it holds the ctl checker project.
cd ctl

# Builds the configure script
autoreconf -vfi

# Note the use of an absolute path to libddd source folder
./configure --with-libddd=$SDD_HOME/libddd/src --with-libits=$SDD_HOME/libits/src --with-antlrc="$tmp"/antlr-3.4-bin

# -j just helps build faster if you have a multiprocessor machine
make -j

# Test suite with many formulae; the election2.ctl contains many CTL syntax examples.
cd tests
./run_all.sh

