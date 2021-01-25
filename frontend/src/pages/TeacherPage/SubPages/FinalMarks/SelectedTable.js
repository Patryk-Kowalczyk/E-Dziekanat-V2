import React, {useState} from 'react';
import "./finalMarks.scss";
import Form from "./Form";
import {useSelector} from "react-redux";

const SelectedTable = ({selected}) => {
        const groupsData = useSelector((state) => state.marks.groups) || [];

        const dataFilter = groupsData.filter((item, i) => item.group_id === selected)

        const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            <Form key={element.unique_number} element={element}/>
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
