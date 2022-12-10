import { DefaultTheme } from 'react-native-paper';
import {StyleSheet} from 'react-native'

export const theme = {
  ...DefaultTheme,
  colors: {
    ...DefaultTheme.colors,
    primary: '#600EE6',
    secondary: '#414757',
    error: '#f13a59',
  },
};

export const styles = StyleSheet.create({
    container: {
        flex: 1,
        margin: 0,
        flexWrap: "wrap",
        alignContent: "center",
        justifyContent: "center"
    },
    box: {
        height: "25%",
        width: "45%",
        margin: 2,
        borderRadius: 5,
        textAlign: "center",
        justifyContent: "center"
    },
    row: {
        flexDirection: "row",
        flexWrap: "wrap",
        width: "100%",
        height: "100%",
        justifyContent: "center",
        alignContent: "center"
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
    text: {
        fontSize: 24,
        color: "#fff"
    },
    ListItem: {
        padding: 15,
        backgroundColor: "#4b88a288",
        borderBottomWidth: 1,
        borderBottomColor: "#eee",
        height: 50,
        width: '100%',
        // margin: 2.5,
    },
    ListItemView: {
        flexDirection: "row",
        justifyContent: "space-between",
        alignItems: "center",
        alignContent:"center",
        fontColor: 'white'
    },
    ListItemViewText: {
        fontSize: 18
    }
});
    