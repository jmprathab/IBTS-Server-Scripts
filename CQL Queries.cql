//Creating Buses
create(bus:Bus{name:"3A"})

create(bus:Bus{name:"96"})

create(bus:Bus{name:"66"})

//Creating Stops
create(stop:Stop{name:"Madukkarai Market"})

create(stop:Stop{name:"Kovaipudur"})

create(stop:Stop{name:"Kuniamuthur"})

create(stop:Stop{name:"Ukkadam"})

create(stop:Stop{name:"Park Gate"})

create(stop:Stop{name:"Gandhipuram"})

create(stop:Stop{name:"Ganapathy"})

create(stop:Stop{name:"Railway Station"})

create(stop:Stop{name:"Town Hall"})

create(stop:Stop{name:"Madukkarai"})

create(stop:Stop{name:"Valayar"})

create(stop:Stop{name:"Aathuppalam"})


//Creating Relatioships

match(s1:Stop{name:"Madukkarai Market"}) match(s2:Stop{name:"Kovaipudur"}) create (s1)-[r:Up{BusName:"3A",distance:6}]->(s2)

match(s1:Stop{name:"Kovaipudur"}) match(s2:Stop{name:"Kuniamuthur"}) create (s1)-[r:Up{BusName:"3A",distance:6}]->(s2)
