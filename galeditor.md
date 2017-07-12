---
title: Guarded Action Language : Editor Features
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: galeditor.html
summary: GAL Parameters.
---

## <a name="fonctionnalites-editeur"></a>4\. GAL Editor features

The Eclipse plugin GAL inherits the editing features of the Eclipse IDE and this eases modeling of concurrent systems.

![](images/captures/1_.png)

One of the interesting features of Eclipse is the well-known auto-completion. By pressing CTRL + SPACE, GAL provides a list of elements which may complement the word according to the characters written, or otherwise the elements that can be placed where the cursor is located.

On-the-fly syntax and some semantic validation are also proposed. Errors are raised in the editor for various common modeling issues such as name conflicts, cycles of calls, visibility issues, etc...

The outline view provides an abstract overview of the GAL system.

The formatter allows to indent and otherwise edit whitespace to make the input look nicer. It can be accessed through a right-click->format, or with the key combination Ctrl-Shift-F.

Templates are proposed to build a new system or transition, accessed through ctrl-space. Some quick-fix actions are also defined to correct name conflicts for instance.

## <a name="transform"></a>5\. GAL transformations

### <a name="transformcall"></a>5.1 Invocation

When the GAL plugin is deployed, a right click on a folder or file will offer the "GAL transformation" menu.

Because the ITS-tools are currently unaware of system or transition parameters, these need to be instantiated before invoking the model-checking procedure. Such a process is a GAL transformation.

The GAL transformation menu currently contains four entries :

![](images/rewritemenu.png)

*   Instantiate parameters : this is the naive approach where the Cartesian product of all possible parameter values is considered for transition parameters. It can be quite explosive if the parameters have large ranges, but it is the baseline operation that needs to be run before calling the model-checker.
*   Flatten model : this is a much more efficient approach to instantiating parameters, where dependencies between parameters are computed and parameters are first separated as much as is possible to avoid building a number of transitions proportional to the Cartesian product of all parameters. In most cases this is the transformation you should use before model-checking.
*   Separate parameters : this transformation instantiates system parameters but preserves transition parameters. It is an intermediate step that produces a model with size linear to the input model, hence there is no explosion in model size to fear. In favorable cases, when parameters are not strongly dependent on each other, it splits transition effects into effects directed by each parameter, then calls the labels of these new transitions. This mechanism can be very effective when the transition relation has a lot of non-determinism. This transformation is incomplete since transition parameters still need to be instantiated, and is provided to allow the user to more easily trace what is happening in the steps leading to analysis.
*   Remove Color : this transformation simplifies arrays to basic integer variables, with value the sum of the array's cells. All accesses to the array are simplified to designate the new variable. This transformation is similar to removing color of a colored Petri net, it produces a simpler model whose behavior in terms of traces is an overapproximation of the original model. This feature has been used for colored Petri nets transformed to GAL, but it is still a beta.

