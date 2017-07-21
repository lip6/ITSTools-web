---
title: Source and Build Repositories
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: repository.html
summary: Where to find the sources on GitHub
---

# Source repository index on GitHub

Because the software has grown pretty large, and due to the way GitHub and 
our online CI services such as Travis interact, the sources for the ITS-tools are spread across 
quite a few repositories.

Practically all of these repositories have online CI setup, so that forking you enables you to
modify the code and reproduce builds easily.

This page will reference them all in one place.

* [libDDD](https://github.com/lip6/libDDD) : core C++ library for DDD and SDD
* [libITS](https://github.com/lip6/libITS) : core symbolic state and transition relation management. Built on top of libDDD.
Repository includes its-reach.
* [ITS-CTL](https://github.com/lip6/ITS-CTL) : CTL model checker, built on top of libITS
* [ITS-LTL](https://github.com/lip6/ITS-LTL) : CTL model checker, built on top of libITS and [Spot](http://spot.lrde.epita.fr)
* [ITSTools](https://github.com/lip6/ITSTools) : main repository, currently hosting most of the eclipse functionality
* [ITS-commandline](https://github.com/yanntm/ITS-commandline) : packaging the command line wrappers to eclipse
* [ITS-Tools-pnmcc](https://github.com/yanntm/ITS-Tools-pnmcc) : benchmark, oracles and tests based on [MCC](mcc.lip6.fr)

Most of these repositories have a small GitHub Pages, providing links to binary or executable result of builds.
e.g. For project **https://github.com/lip6/libDDD** the page would be at **https://lip6.github.io/libDDD**.
The Readme visible on each project's homepage also gives a link to it.

For build purposes, we also have some repositories set up to build our dependencies :
* [ITS-Tools-dependencies](https://github.com/yanntm/ITS-Tools-Dependencies) 
* [LTSmin-binaryBuilds](https://github.com/yanntm/LTSmin-BinaryBuilds) : slightly hacked LTSmin
* [Spot-binaryBuilds](https://github.com/yanntm/Spot-BinaryBuilds) : subset of Spot is built
* [mccmodels](https://github.com/yanntm/pnmcc-models-2017mccmodels) : MCC models repackaged and patched

For the web page itself :
* [ITSTools-web](https://github.com/lip6/ITSTools-web) : the repository holding the page you are viewing

