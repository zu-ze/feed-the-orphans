import React, { useState } from "react";
import { StyleSheet, Text, View, TouchableOpacity} from "react-native";

export const Flex = ()  => {
    return (
        <View
            style={[styles.container, {flexDirection: "row"}]}
        >
            <View style={[ styles.box, {backgroundColor: "red" }]} />
            <View style={[ styles.box, {backgroundColor: "darkorange" }]} />
            <View style={[ styles.box, {backgroundColor: "green" }]} />
        </View>
    )
}


export const FlexDirectionBasics = () => {
    const [flexDirection, setFlexDirection] = useState("column");

    return (
        <PreviewLayout 
            label="flexDirection"
            values={["column", "row", "row-reverse", "column-reverse"]}
            selectedValue={flexDirection}
            setSelectedValue={setFlexDirection}
        >
            <View style={[styles.box, {backgroundColor: "powderblue"}]} />
            <View style={[styles.box, {backgroundColor: "skyblue"}]} />
            <View style={[styles.box, {backgroundColor: "steelblue"}]} />
        </PreviewLayout>
    )
}

const AlignItemsLayout = () => {

}

const PreviewLayout = ({
    label,
    children,
    values,
    selectedValue,
    setSelectedValue,
}) => (
    <View style={{padding: 10, flex: 1}}>
        <Text style={styles.label} >{label}</Text>
        <View style={styles.row} >
            {values.map((value) => (
                <TouchableOpacity
                    key={value}
                    onPress={() => setSelectedValue(value)}
                    style={[styles.button, selectedValue === value && styles.selected,]}
                >
                    <Text style={[styles.buttonLabel, selectedValue === value && styles.selectedLabel, ]} >
                        {value}
                    </Text>
                </TouchableOpacity>
            ))}
        </View>
        <View style={[styles.container, {[label]: selectedValue}]} >
            {children}
        </View>
    </View>
)

const styles = StyleSheet.create({
    container: {
        flex: 1,
        margin: 8,
        backgroundColor: "aliceblue",
        padding: 20,
        flexWrap: "wrap",
        alignContent: "center",
    },
    box: {
        height: 100,
        width: 300,
        margin: 2,
    },
    row: {
        flexDirection: "row",
        flexWrap: "wrap",
    },
    button: {
        paddingHorizontal: 8,
        paddingVertical: 6,
        borderRadius: 4,
        backgroundColor: "oldlace",
        alignSelf: "flex-start",
        marginHorizontal: "1%",
        marginBottom: 6,
        minWidth: "48%",
        textAlign: "center",
    },
    selected: {
        backgroundColor: "coral",
        borderWidth: 0,
    },
    buttonLabel: {
        fontSize: 12,
        fontWeight: "500",
        color: "coral",
    },
    selectedLabel: {
        color: "white",
    }, 
    label: {
        textAlign: "center",
        marginBottom: 10,
        fontSize: 24,
    },
});