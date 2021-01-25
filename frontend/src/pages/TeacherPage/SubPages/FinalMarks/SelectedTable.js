import React, {useState} from 'react';
import "./finalMarks.scss";
import Form from "./Form";
import {useSelector} from "react-redux";

const SelectedTable = ({selected}) => {
        const groupsData = useSelector((state) => state.marks.finalGrades) || [];

        const dataFilter = groupsData.filter((item, i) => item.id_subject === Number(selected))
        console.log(dataFilter)
        console.log(selected)

        const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            <Form key={"form" + element.id_finalgrade} element={element}/>
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
