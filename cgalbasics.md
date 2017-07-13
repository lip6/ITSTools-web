---
title: Composite Guarded Action Language Basics
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: cgalbasics.html
summary: GAL Concepts.
---

# Composite concepts

## GAL Specification

GAL files are simply text files with the extension .gal . For example, foo.gal is a valid GAL filename. 
Each file defines a single GAL _specification_ that may contain one or more type declarations, a **main** instance, and properties.

## Composite Type Declaration

A Composite GAL type declaration (or just a Composite) is characterized by a name, and contains a sequence of declarations (instances, synchronizations).

A Composite is declared with the keyword **composite**, followed by the system name. 
The name must start with a letter of the alphabet and should be a C-style identifier (only using letters, underscore and numbers). 

A good practice is to give a meaningful name to the system created, particularly if it will be reused in a further Composite ITS definition.

The body of the system name are then placed between a pair of braces.

The [previous section](cgal.md) shows a declaration of an example Composite GAL system named _game_.

## Instance declarations

A Composite GAL model declares instances. 
The instances manipulated in a Composite can GAL, Composite, or arrays of these. 
There are no variables besides the instances in a Composite. 

There are no dynamic allocation or variable length structures such as lists.
To model these using an array is only possible if an upper bound on its size is known a priori.

In this section, we describe how instance of a composite GAL are declared.

### Instance  variables

Plain instance variables are introduced with their **type** followed by the instance name starting with a letter. 
The instance name must be a C-style identifier.

The name must be unique within the scope of the composite definition, and cannot be reused for another instance within the same type. 

Each instance can optionally be initialized, as described in the [section on parameters](pgal.md).
Otherwise it has as initial state the initial defined by its type.

This example of a composite __game__ contains two instances :

{% highlight C %}
{% include_relative galfiles/sample-9.gal %}
{% endhighlight %}

### Array declarations

An array declaration allows to declare a fixed size array of instances. 
All instances must have the same type.

Instances can optionally be initialized, as described in the [section on parameters](pgal.md).

An array is declared by adding square brackets with a size for the array after the type of the instances it contains.
A semicolon ends the array declaration.

Here is an example of a system with a declaration of an array:

{% highlight C %}
{% include_relative galfiles/sample-10.gal %}
{% endhighlight %}

There are three instances of __Pong__ in this example, __p1__ can send his ball to __p2[0]__ and
__p2[1]__ (and the ball gets "duplicated", both of them receive it simultaneously), or send it to __p2[2]__.
The CTL formula is not satisfied due to the latter case.

## Synchronizations

There are two ways for a Composite to reach a new state :
* one of the instances progresses using one of its private (unlabeled) events. The state for that instance is updated in the global state.
* a __synchronization__ is fired, forcing events (labels) to occur simultaneously in subcomponents.



### Synchronization declaration

Synchronizations  allow to step atomically from a source state to a (set of) successor state(s). 
They force events or labels to occur synchronously in subcomponents.

Synchronizations have a unique name and may carry a label that is a string. 
Synchronizations like GAL transitions can have a guard, but this is optional and only useful
in conjunction with [parameters](pgal.md).

When a synchronization is fired, it executes atomically all the actions it contains in sequence. 
Actions are limited to calls to a label of an immediately nested instance, or to calls to __self__ labels
labeling synchronizations of the type itself.

Labeled synchronizations _cannot be fired_ if they are not called from another synchronization
 or synchronized externally (within an enclosing ITS composite). 
 
 Synchronizations without a label are "private" and can be fired
  any time their guard is true, with interleaving semantics. 
  
  A self-contained Composite (not intended for further composition) typically bears no labels on
   synchronizations (an exception is made for an "elapse" label interpreted as signifying a time tick
   for handling discrete time).  

Syntactically, a synchronization is declared with the keyword **synchronization**, 
followed by a unique identifier for the synchronization within the scope of the enclosing type. 

The transition guard (a Boolean expression over parameters) is surrounded by brackets 
(that can be omitted and defaults to **true**). 
The transition can optionally be labeled, as introduced with the keyword **label** followed
 by double quoted string defining the label. 
 
Finally the statements comprising the transition body are placed in a block surrounded by curly braces and separated by semi-columns **;**.
 
This example system based off of the previous one contains two synchronizations of which one is labeled :

{% highlight C %}
{% include_relative galfiles/sample-11.gal %}
{% endhighlight %}

The property holds again for this model, since "paf" is never called from outside, it cannot occur.

### Statements

Statements are operations that generally update the state of the system variables. 

Statements are sequentially composed using a semi-column **;** within the body of a transition.

The most common type of statement is the the call to a label of a nested instance e.g. **p2."pong"**.
This makes the designated instance __p2__ progress by the designated label __"pong"__ if it can.

The __self__ call statement introduces non-determinism in the execution by offering several alternatives (_any_ synchronization bearing the label can be fired).
Using the __self__ call and labeled synchronizations helps reuse semantic bricks
as well as compose non-deterministic choices along a path in a compact way. 

Other basic statements include an **if-then-else** control structure, and an **abort* instruction.
Other statements such as limited **for-loop** control structure are provided (see [parametric GAL](pgal.md)). 
These statements are limited to usage with parameters in Composite type definitions (and are very useful in conjunction with arrays of instances).

A more formal presentation of composite semantics can be found in my [habilitation](https://pages.lip6.fr/Yann.Thierry-Mieg/hdr-ytm.pdf) page 63. 

#### Call Instance

Depending on the type of the instance, this is not necessarily a deterministic choice.
The state of the instance within the composite gets updated to reflect one of these potential choices.

If the instance cannot collaborate in this synchronization at this time, i.e. no events bearing that label were enabled
this set of choices is the empty set.
In such a case the synchronization cannot be fired, it is cancelled.

Syntactically, reference an instance of the composite (plain instance or cell of an array), separate with **.** and add the target label
between double quotes.

In this variant of the PingPong example, player one can reset the ball, and player two can discard it using private transitions.
This forces a cycle, where __p1__ and __p2__ synchronize, then one of them resets, then the other resets, then the cycle begins again.
This variant is not deadlocked (**AG(EX(true))** holds).

{% highlight C %}
{% include_relative galfiles/sample-13.gal %}
{% endhighlight %}


#### Call Self

The call action allows to call a label of the current Composite, i.e. non-deterministically choose any of the synchronizations that bear this label, and execute its actions. 

This powerful mechanism allows to model much more concisely when the transition relation carries non-determinism.

It is the dual to the composition mechanism offered by **;** within a synchronization:
it creates sums or disjunctions of alternative behaviors. 
Because composition is asymetric it is not quite the equivalent of a Boolean conjunction but the analogy still holds.

Note that the whole ITS semantics is defined using sets, i.e. the successor relation returns a set of successors. 
Hence if no labeled action is enabled in some states at the point of call, no successors are produced, canceling the effect of the calling the enclosing transition for the concerned states, like an abort action.

Syntactically, a call is introduced by the keyword <span class="galElement">self</span>, followed by a column '.', followed by a label between double quotes.

This example shows a use of a call to model a $n to n$ topology where any Ping can send a ball to any Pong.

{% highlight C %}
{% include_relative galfiles/sample-12.gal %}
{% endhighlight %}

Note that **3+3=6** synchronization are used to model **3*3=9** possible outcomes; this multiplicative effect can blow up significantly helping to represent
compactly complex synchronization patterns.

In this case the property is true again, every Pong eventually ends up getting a ball since there are as many Ping as Pong players.





