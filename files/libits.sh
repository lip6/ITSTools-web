#! /bin/sh

# we reuse the SDD_HOME variable see above script for libDDD.
cd $SDD_HOME

# checkout the libits trunk project
svn co --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/libits/trunk ./libits

# We should have a libits folder now, it holds the its library.
cd libits

# Builds the configure script
autoreconf -vfi

# Note the use of an absolute path to libddd source folder
./configure --with-libddd=$SDD_HOME/libddd/src --with-antlrc="$tmp"/antlr-3.4-bin   --with-antlrjar="$tmp"/antlr-3.4-bin/antlr-3.4-complete.jar

# -j just helps build faster if you have a multiprocessor machine
make -j

# Errors in XML loader files is due to missing libExpat.
# A test suite to check everything is set up correctly.
cd tests
./run_all.sh

