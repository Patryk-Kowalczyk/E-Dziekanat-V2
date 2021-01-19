import React, {useState} from 'react';
import "./individualmarks.scss";
import Form from "./Form";
import {useSelector} from "react-redux";

const SelectedTable = ({selected}) => {
        const groupsData = useSelector((state) => state.classes.groups) || [];

        const dataFilter = groupsData.filter((item, i) => item.group_id === selected)

        const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            // <>
                            //     <div key={element.unique_number} className="nameLastName">
                            //         {element.first_name}
                            //         {" "}
                            //         {element.last_name}
                            //         <div style={{paddingLeft: "10px"}}>{"Oceny: "}</div>
                            //         {element.marks.map((e, i) => {
                            //             return (
                            //                 <div style={{paddingLeft: "10px"}} className="mark" key={e.id}>
                            //                     <div className="mark2">{e.mark}</div>
                            //                 </div>)
                            //         })}
                            //         <button>Edytuj</button>
                            //     </div>
                            // </>
                            //    ZROBIE TYLKO OSOBY
                            <Form key={element.first_name + element.uniqueID} element={element}/>

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
