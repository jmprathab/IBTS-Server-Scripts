
begin
create constraint on (n:`User`) assert n.`mobile` is unique;
commit
begin
create (_1250:`User` {`address`:"12/382, Anbu Nagar, Madukkarai Market, Coimbatore", `balance`:105, `email`:"jm.prathab@gmail.com", `mobile`:"8110031139", `name`:"Prathab", `password`:"5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8", `time`:1483535032139})
create (_1251:`Conductor` {`address`:"12/382, Anbu Nagar, Madukkarai Market, Coimbatore", `mobile`:"9025731119", `name`:"Prathab(Conductor)", `password`:"5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8", `time`:1483535084269})
create (_2228:`Bus` {`name`:"3A"})
create (_2229:`Bus` {`name`:"96"})
create (_2230:`Bus` {`name`:"66"})
create (_2231:`Stop` {`name`:"Madukkarai Market"})
create (_2232:`Stop` {`name`:"Kovaipudur"})
create (_2233:`Stop` {`name`:"Kuniamuthur"})
create (_2234:`Stop` {`name`:"Ukkadam"})
create (_2235:`Stop` {`name`:"Park Gate"})
create (_2236:`Stop` {`name`:"Gandhipuram"})
create (_2237:`Stop` {`name`:"Ganapathy"})
create (_2238:`Stop` {`name`:"Railway Station"})
create (_2239:`Stop` {`name`:"Town Hall"})
create (_2240:`Stop` {`name`:"Madukkarai"})
create (_2241:`Stop` {`name`:"Valayar"})
create (_2242:`Stop` {`name`:"Aathuppalam"})
create (_2231)-[:`Up` {`BusName`:"3A", `distance`:6}]->(_2232)
create (_2232)-[:`Down` {`BusName`:"66", `distance`:7}]->(_2240)
create (_2232)-[:`Up` {`BusName`:"66", `distance`:6}]->(_2233)
create (_2232)-[:`Down` {`BusName`:"3A", `distance`:6}]->(_2231)
create (_2232)-[:`Up` {`BusName`:"3A", `distance`:3}]->(_2233)
create (_2233)-[:`Down` {`BusName`:"66", `distance`:6}]->(_2232)
create (_2233)-[:`Up` {`BusName`:"66", `distance`:5}]->(_2242)
create (_2233)-[:`Down` {`BusName`:"3A", `distance`:3}]->(_2232)
create (_2233)-[:`Up` {`BusName`:"3A", `distance`:4}]->(_2234)
create (_2234)-[:`Down` {`BusName`:"66", `distance`:4}]->(_2242)
create (_2234)-[:`Up` {`BusName`:"66", `distance`:2}]->(_2236)
create (_2234)-[:`Down` {`BusName`:"96", `distance`:4}]->(_2239)
create (_2234)-[:`Up` {`BusName`:"96", `distance`:7}]->(_2240)
create (_2234)-[:`Down` {`BusName`:"3A", `distance`:4}]->(_2233)
create (_2234)-[:`Up` {`BusName`:"3A", `distance`:5}]->(_2235)
create (_2235)-[:`Down` {`BusName`:"3A", `distance`:5}]->(_2234)
create (_2235)-[:`Up` {`BusName`:"3A", `distance`:2}]->(_2236)
create (_2236)-[:`Down` {`BusName`:"66", `distance`:2}]->(_2234)
create (_2236)-[:`Up` {`BusName`:"66", `distance`:1}]->(_2237)
create (_2236)-[:`Up` {`BusName`:"96", `distance`:5}]->(_2238)
create (_2236)-[:`Down` {`BusName`:"3A", `distance`:2}]->(_2235)
create (_2236)-[:`Up` {`BusName`:"3A", `distance`:1}]->(_2237)
create (_2237)-[:`Down` {`BusName`:"66", `distance`:1}]->(_2236)
create (_2237)-[:`Down` {`BusName`:"3A", `distance`:1}]->(_2236)
create (_2238)-[:`Down` {`BusName`:"96", `distance`:5}]->(_2236)
create (_2238)-[:`Up` {`BusName`:"96", `distance`:2}]->(_2239)
create (_2239)-[:`Down` {`BusName`:"96", `distance`:2}]->(_2238)
create (_2239)-[:`Up` {`BusName`:"96", `distance`:4}]->(_2234)
create (_2240)-[:`Up` {`BusName`:"66", `distance`:7}]->(_2232)
create (_2240)-[:`Down` {`BusName`:"96", `distance`:7}]->(_2234)
create (_2240)-[:`Up` {`BusName`:"96", `distance`:10}]->(_2241)
create (_2241)-[:`Down` {`BusName`:"96", `distance`:10}]->(_2240)
create (_2242)-[:`Down` {`BusName`:"66", `distance`:5}]->(_2233)
create (_2242)-[:`Up` {`BusName`:"66", `distance`:4}]->(_2234)
;
commit
