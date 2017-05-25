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
./configure --with-libddd=$SDD_HOME/libddd/src
# -j just helps build faster if you have a multiprocessor machine
make -j


# we reuse the SDD_HOME variable see above script for libDDD.
cd $SDD_HOME
# checkout the ctl trunk project
svn co -r 2445 --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/ctl/trunk ./ctl
# We should have a ctl folder now, it holds the ctl checker project.
cd ctl
# Builds the configure script
autoreconf -vfi
# Note the use of an absolute path to libddd source folder
./configure --with-libddd=$SDD_HOME/libddd/src --with-libits=$SDD_HOME/libits/src
# -j just helps build faster if you have a multiprocessor machine
make -j

# update tests to use --backward
cd tests
svn up -r 2447 --username anonymous --password anonymous 
cd ..
