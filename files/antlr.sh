
# ---------------
# install antlr
# ---------------

# create a dedicated install dir
mkdir antlr-3.4-bin

# install antlr
wget http://www.antlr3.org/download/antlr-3.4.tar.gz
tar -xzvf antlr-3.4.tar.gz

cp antlr-3.4/lib/antlr-3.4-complete.jar ./antlr-3.4-bin
tmp=$(pwd)
cd ./antlr-3.4/runtime/C
./configure --prefix="$tmp"/antlr-3.4-bin #--enable-64bit
make
make install
cd -

# ---------------
# install libits related tools with :

# ./configure   --with-antlrc="$tmp"/antlr-3.4-bin   --with-antlrjar="$tmp"/antlr-3.4-bin/antlr-3.4-complete.jar
