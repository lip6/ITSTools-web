---
title: Structural Reductions for Petri nets
keywords: Petri net, Structural Reduction
tags: [petri]
sidebar: home_sidebar
permalink: structural.html
summary: Structural reduction rules and experiments
---

# Structural reductions for Petri nets

## Structural Reductions

A structural reduction looks at the *structure* of a system and attempts to build a smaller system that preserves the properties of interest.

ITS-tools is capable of applying a large body of structural reduction rules to Petri nets, colored or not, resulting in much smaller systems and/or actually proving properties.

## Experiments

The following experiments were run on Jan 27, 2020. We took all model instances from the Model-Checking contest 2019 edition, where all properties had been answered in the GlobalProperties (deadlock detection) 
 ReachabilityCardinality and ReachabilityFireability examinations.
 
For each model, we run a procedure that tries to 

* prove invariants are true using an over-approximation of the system encoded as constraints in an SMT problem
* prove invariants are false using an under-approaximation of the system obtained by directed or random runs that seek to find a counter-example state
* reduce the system to a smaller one that preserves properties of interest using structural reduction rules

The full experimental procedure is the following :

* We extract from official verdict file from the contest organizers some oracle files for each model, as well as models and formulas [see the Github project](https://github.com/yanntm/pnmcc-models-2019)
* We removed two colored models that our tool cannot translate, due to use of negative arc annotations which are not fully supported : DatabaseWithMutex and PhilosophersDyn
* We use [this project](https://github.com/yanntm/ITS-Tools-pnmcc) that hosts a procedure to install ITS-tools and its dependencies and can compare traces to test oracles 
* We ran the experiments on a cluster of machines using OAR, and collected the results in [this log](./files/20200127.tgz) 
* We ran the "logs2csv.pl" script (it is in the archive) on these raw outputs to obtain the "log.csv" file with tabular statistics extracted from the raw logs
* We finally analyzed this data using Excel/OpenOffice to obtain global values (duration, places removed, instances fully solved, etc...) as well as some queries directly on the raw logs, e.g. `grep FORMULA *out | wc -l`...

## Description of reduction rules

Many of the rules we use are currently unpublished thus will not (yet) be described in detail here.

Instead we chose a few representative runs and generated graphical representations of rule application through the decision procedure.

In these drawings :
* The top of each page has a summary of how many places and transitions are left, and which rule is being applied.
* places are ovals and transitions are rectangles ; while place names are preserved throughout the transformations, transition names are not (they get reindexed periodically otherwise in some cases names could overflow due to agglomerations). 
* A marked place has its marking in parenthesis after the place name, e.g. `sos1_eps8_e3b1_equals_0(1)` means the place `sos1_eps8_e3b1_equals_0` has one token.
* Any object with a dashed border is incompletely shown; some arcs relating it to the rest of the model are not shown
* Red places are places that belong to the support of the property ; we are interested in preserving reachability of states *projected* over these red support places
* Blue objects correspond to the elements that the rule currently being applied will modify or discard ; purple objects are both in the support and being modified by a rule.

Here are some examples we built, all random walk variants are disabled in these runs, so if some properties can proved (with SMT) the support may reduce, but properties that have a counter-example cannot be solved.
For most of these examples we exhibit what happens for a single property in these conditions. 
* [EGFr](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/EGFr-PT-10420_RF10.pdf) : an example with nice prefix of interest reductions despite a complex structure
* [FMS](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/FMS-PT-020_RC8.pdf) : an example with a very simple resulting model
* [Angiogenesis](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/Angiogenesis-PT-05_RC0.pdf) : an example taken from a biological interaction, where SMT based implicit place detection is used to apply further reductions
* [AirplaneLD](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/AirplaneLD-PT-0010_RC.pdf) : an example with many formulas initially, we can see the support diminish as properties are proved.
* [DLCshifumi](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/DLCshifumi-PT-3b_RC.pdf) : a larger example (7058 places, 9611 transitions initially), run with a small limit of 100 steps (normal setting is 1 million) for counter-example search, and where all the variants of agglomeration rules are not graphically represented (this means "only" 1181 steps out of roughly 15000 are represented). The file is still 100 MB approximately...


