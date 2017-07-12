---
title: Guarded Action Language : Parameters
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: pgal.html
summary: GAL Parameters.
---


### System parameters

A GAL type declaration can optionally declare one or more _type parameters_. 
A type parameter essentially declares a symbolic name for an integer constant, that can then be used within the various instructions of the GAL system (including initializations, typedef, guards, statements...). 

Parameter names start with a $ sign to avoid any confusion with the variables of the system. 
Parameters are given a value directly after their declaration. 

Note that when instantiating a GAL within the context of composite ITS, parameters can be given a value (different from the value given in the parameter declaration).
Thus type parameters can be used to simulate a constructor for the GAL.

Syntactically, parameters are given as a parenthesized comma separated list, just after the name of the system. 
Only constant expressions may be used in parameter initializations.

{% highlight C %}
{% include_relative galfiles/sample-param.gal %}
{% endhighlight %}


### Parameter type definitions

A parameter type definition allows to define a symbolic name for a given range of integers from min to max. These type definitions are used when declaring transition parameters. They allow to define a set of similar transitions in a compact and readable manner.

Syntactically, a type definition is introduced with the keyword <span class="galElement">typedef</span> followed by a unique name for this type, followed by the actual range specification in the form "= min..max;". min and max are integer expressions built from type parameters and constants only.

Here is an example of a system with some parameter type definitions:

{% highlight C %}
{% include_relative galfiles/paramtype.gal %}
{% endhighlight %}


### Transition parameters

Transitions can optionally define one or more parameters that allow a more concise and readable representation of a complex transition relation. Parameters have a type that is defined as a range of integers, introduced at the system level using a **typedef**. Semantically, each parameter can be replaced in the transition effects by each of the possible values in its type, producing several alternative transitions from a single transition that bears parameters.

Syntactically, transition parameters are declared in a parenthesized comma separated list just after the transition name, with a syntax reminiscent of arguments for a function or method. Each parameter is defined by giving its type followed by the parameter name which must start with a $ sign and cannot shadow a type (sytem level) parameter name.

This example, already used above when discussing type parameters:

{% highlight C %}
{% include_relative galfiles/param.gal %}
{% endhighlight %}

Is equivalent to this version that does not use parameter definitions. :

{% highlight C %}
{% include_relative galfiles/param.inst.gal %}
{% endhighlight %}


System parameters (introduced just after the name of the system) can be used anywhere in the specification. Transition parameters (introduced just after the name of the transition) have the transition body as scope.


