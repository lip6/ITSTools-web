---
title: LTSmin Interaction
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: ltsmin.html
summary: Exchanging models with LTSmin.
---

# LTSmin

LTSmin is multi-solution model-checker for a variety of formalisms.
They define an intermediate API called PINS that puts a pivot interface between
solution engines and (explicit) transition relations. 

We offer two bridges to LTSmin :
* From GAL to LTSmin : **(NEW)** we can build a shared object that LTSmin can load to model-check GAL using LTSmin. 
This transformation includes the usual GAL simplifications as well as fine grain partial order analysis relying on SMT.
* From LTSmin to its-tools : the command line its-tools accept an ETF as input, which can be produced by LTSmin as a side
 effect of reachability analysis. This enables LTL or CTL model-checking of these specifications.  
 
## GAL to PINS

### How to build a PINS model

### PINS translation

### Activating POR analysis

## ETF to its-tools

### Producing ETF files

### Using ETF files

### TGTA for LTL
