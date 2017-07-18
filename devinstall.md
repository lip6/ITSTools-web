---
title: Developper's corner
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: devinstall.html
summary: How to configure Eclipse to develop plugins with GAL dependencies.
---

# Developer's corner : setting up Eclipse to write a GAL conversion.

Due to popular demand, here are a few basic instructions to get an eclipse running in development mode.

1.  Download Eclipse, we recommend "DSL developer" so you will get Xtext packaged in the bundle. Otherwise, install plugins Xtext and Xtend from eclipse release site into existing (>= Luna) eclipse.
2.  Install all the dependencies of GAL, select "Help->install new software" and install ITS modeler as explained for plain users here : [for ITS Modeler eclipse front-end](itstools.md#sec:modinst). Reboot.
3.  Fork the repository __https://github.com/lip6/ITSTools__ onto your github account
4.  Within Eclipse, under __Perspectives__ you have GIT, open that, then clone your new repository 
5.  In the "working tree" you now can see on the left, right-click, then "Import" the project you want to inspect or modify. 

Some additional tips :
* If you have the **m2e** maven to eclipse plugins deployed, you will get less problems with missing dependencies 
* For Xtext based projects, go to Java perspective, in the project fr.lip6.move.gal navigate in the folder src/ to package fr/lip6/move/gal, and right-click "Run As...->MWE2 workflow" the .mwe2 file. Hit "y" when it asks for permission to download antlr.

There should be no more compilation errors, you can inspect the GAL grammar (.xtext) and its metamodel as well as the utility classes provided (in particular we recommend use of class GF2 static factory operations rather than direct use of EMF generated GalFactory).

We use maven to build the actual plugins. Example maven pom.xml configuration files are available to allow to quickly setup an update site. 
Please activate "travis-ci" on your forked repository to benefit from this.