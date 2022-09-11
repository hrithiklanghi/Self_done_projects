def findNextCellToFill(sudoku):
    for x in range(9):
        for y in range(9):
            if sudoku[x][y] == 0:
                return x, y
    return -1, -1
    
def valid_minigrid(mat_row, a, b, num):
    m=(a//3)*3
    n=(b//3)*3

    for i in range(m, m+3):
        for j in range(n, n+3):
            if (i!=a or j!=b):
                if mat_row[i][j]!=0:
                    if mat_row[i][j]==num:
                        return False
    return True
    
def validity(mat_row):
    for r in range(9):
        for t in range(9):
            if mat_row[r][t]!=0:
                new_num=mat_row[r][t]
                for q in range(t+1, 9):
                    if mat_row[r][t]==mat_row[r][q]:
                        print("Error in row ",r+1," at ",t+1," cell.")
                        return False
                for w in range(r+1, 9):
                    if mat_row[r][t]==mat_row[w][t]:
                        print("Error in column ",r+1," at ", t+1, " cell.")
                        return False
                if (valid_minigrid(mat_row, r, t, mat_row[r][t]))==False:
                        print("Error in minigrid at ",r+1,",",t+1, " cell.",mat_row[r][t], type(mat_row[r][t]))
                        return False
    return True
    
def isValid(sudoku, i, j, e):
    rowOk = all([e != sudoku[i][x] for x in range(9)])
    if rowOk:
        columnOk = all([e != sudoku[x][j] for x in range(9)])
        if columnOk:
            secTopX, secTopY = 3*(i//3), 3*(j//3)
            for x in range(secTopX, secTopX+3):
                for y in range(secTopY, secTopY+3):
                    if sudoku[x][y] == e:
                        return False
            return True
    return False


def solveSudoku(sudoku, i=0, j=0):
    global backtracks
    i, j = findNextCellToFill(sudoku)
    if i == -1:
        return True

    for e in range(1, 10):
        if isValid(sudoku, i, j, e):
            sudoku[i][j] = e
            if solveSudoku(sudoku, i, j):
                return True
            sudoku[i][j] = 0
    return False


def printsudoku(sudoku):
    print("\n\n")
    for i in range(len(sudoku)):
        line = ""
        if i == 3 or i == 6:
            print("---------------------")
        for j in range(len(sudoku[i])):
            if j == 3 or j == 6:
                line += "| "
            line += str(sudoku[i][j])+" "
        print(line)

