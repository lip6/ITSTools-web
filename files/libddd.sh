#! /bin/sh

# setup SDD_HOME variable
export SDD_HOME=/data/thierry/SDD/


mkdir $SDD_HOME
cd $SDD_HOME

# checkout the libddd trunk project first
# login: anonymous pass : anonymous
svn co --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/libddd/trunk ./libddd

# We should have a libddd folder now, it holds the ddd/sdd library.
cd libddd

# Builds the configure script
autoreconf -vfi

# run configure
./configure

# -j just helps build faster if you have a multiprocessor machine
make -j

# There may be some warnings, but if no real errors occur you are ok.
cd demo
# just a small test to check everything is set up correctly.
./tst1
