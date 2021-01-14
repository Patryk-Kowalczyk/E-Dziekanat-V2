import React from 'react';
import data from "./data";
import "./individualmarks.scss";


const SelectedTable = ({selected}) => {
        const dataFilter = [...data].filter((item, i) => item.id === Number(selected))


        const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            <>
                                <div key={element.uniqueID} className="nameLastName">
                                    {element.name}
                                    {element.lastName}
                                    <div style={{paddingLeft: "10px"}}>{"Oceny: "}</div>
                                    {element.marks.map((e, i) => {
                                        return (
                                            <div style={{paddingLeft: "10px"}} className="mark" key={e.id}>
                                                <div className="mark2">{e.mark}</div>
                                            </div>)
                                    })}
                                    <button>Edytuj</button>
                                </div>
                            </>
                        )
                    }
                ))

        })

        return (
            <>
                {studentsGroup}
            </>
        );
    }
;

export default SelectedTable;
